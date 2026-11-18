
const projectsContainer = document.querySelector('#projects');

const API_URL = "https://gently-firewire-hypothetical-van.trycloudflare.com/projects-api/api/projects";

// Корень сайта GitHub Pages
const SITE_BASE_URL = new URL('./', document.baseURI);

function element(tag, className, text) {
    const node = document.createElement(tag);

    if (className) node.className = className;
    if (text !== undefined) node.textContent = text;

    return node;
}

// Преобразование пути из БД в адрес GitHub Pages
function projectUrl(value) {
    if (typeof value !== 'string' || !value.trim()) {
        return null;
    }

    try {
        const path = value.trim().replace(/\\/g, '/').replace(/^\/+/, '');
        const url = new URL(path, SITE_BASE_URL);

        if (!['http:', 'https:'].includes(url.protocol)) {
            return null;
        }

        if (url.origin !== SITE_BASE_URL.origin ||
            !url.pathname.startsWith(SITE_BASE_URL.pathname)) {
            return null;
        }

        return url.href;
    } catch {
        return null;
    }
}

function createCard(project) {
    const card = element('article', 'project');

    const name = typeof project.name === 'string'
        ? project.name
        : 'Projekt bez nazwy';

    const projectLink = projectUrl(project.link);
    const imageLink = projectUrl(project.image);
    const databaseLink = projectUrl(project.database);

    // PHP нельзя запустить на GitHub Pages
    const requiresPhp = typeof project.link === 'string' &&
        /\.php(?:$|[?#])/i.test(project.link.trim());

    // Изображение проекта
    const preview = element(
        projectLink && !requiresPhp ? 'a' : 'div',
        'project-image'
    );

    if (projectLink && !requiresPhp) {
        preview.href = projectLink;
    }

    if (imageLink) {
        const image = element('img');

        image.src = imageLink;
        image.alt = 'Podgląd projektu: ' + name;
        image.loading = 'lazy';
        image.decoding = 'async';

        image.addEventListener('error', () => {
            image.remove();
            preview.append(
                element('span', 'image-fallback', 'Podgląd niedostępny')
            );
        }, { once: true });

        preview.append(image);
    } else {
        preview.append(
            element('span', 'image-fallback', 'Brak podglądu')
        );
    }

    // Информация о проекте
    const info = element('div', 'project-info');
    const heading = element('h3', '', name);

    if (projectLink && !requiresPhp) {
        const title = element('a', 'project-title');

        title.href = projectLink;
        title.append(heading);

        info.append(title);
    } else {
        info.append(heading);

        info.append(
            element(
                'p',
                'project-unavailable',
                requiresPhp
                    ? 'Projekt wymaga serwera PHP'
                    : 'Strona projektu niedostępna'
            )
        );
    }

    // Технологии
    const technologies = typeof project.technologies === 'string'
        ? project.technologies.split(',')
            .map(item => item.trim())
            .filter(Boolean)
        : [];

    if (technologies.length) {
        const list = element('ul', 'tech');

        list.setAttribute('aria-label', 'Technologie');

        technologies.forEach(item => {
            list.append(element('li', '', item));
        });

        info.append(list);
    }

    // Скачивание базы данных
    const download = element(
        databaseLink ? 'a' : 'span',
        'download',
        'Pobierz bazę danych'
    );

    if (databaseLink) {
        download.href = databaseLink;
        download.setAttribute('download', '');
    } else {
        download.classList.add('download-unavailable');
        download.setAttribute(
            'aria-label',
            'Plik bazy danych jest niedostępny'
        );
    }

    card.append(preview, info, download);

    return card;
}

function showMessage(message, error = false, retry = false) {
    const status = element(
        'p',
        error ? 'status status-error' : 'status',
        message
    );

    status.setAttribute('role', error ? 'alert' : 'status');

    projectsContainer.replaceChildren(status);

    if (retry) {
        const button = element(
            'button',
            'retry-button',
            'Spróbuj ponownie'
        );

        button.type = 'button';
        button.addEventListener('click', loadProjects, { once: true });

        projectsContainer.append(button);
    }
}

async function loadProjects() {
    if (!projectsContainer) return;

    projectsContainer.setAttribute('aria-busy', 'true');
    showMessage('Ładowanie projektów…');

    try {
        const response = await fetch(API_URL, {
            headers: {
                Accept: 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error('HTTP ' + response.status);
        }

        const data = await response.json();

        if (!Array.isArray(data)) {
            throw new Error('Nieprawidłowy format danych');
        }

        const cards = data
            .filter(project => project && typeof project === 'object')
            .map(createCard);

        if (cards.length) {
            projectsContainer.replaceChildren(...cards);
        } else {
            showMessage('Nie ma jeszcze projektów do wyświetlenia.');
        }

    } catch (error) {
        console.error('Nie udało się załadować projektów:', error);

        showMessage(
            'Nie udało się załadować projektów.',
            true,
            true
        );

    } finally {
        projectsContainer.setAttribute('aria-busy', 'false');
    }
}

loadProjects();
