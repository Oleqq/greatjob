# GreatJob

Лендинг для сервиса поиска работы. Репозиторий содержит два связанных, но независимых проекта:

1. **`static/`** — исходники вёрстки (Pug + SCSS + native JS), собранные по [макету в Figma](https://www.figma.com/design/GvYjV98aVqGmfqyVZEjx9a/GreatJob?node-id=1-1100&m=dev). Источник истины для всех стилей и скриптов.
2. **`wordpress/greatjob/`** — WordPress-тема, которая эту вёрстку использует: ACF Pro (flexible content + local JSON + Options Pages), 3 custom post type, без нативных меню WordPress.

Правки в вёрстку вносятся только в `static/`, пересобираются и копируются в `wordpress/greatjob/assets/`. Подробный процесс — в [docs/wordpress.md](docs/wordpress.md).

## Стек

| Слой | Технологии |
| --- | --- |
| Вёрстка | Pug, SCSS, модульный native JavaScript, esbuild, Sass |
| WordPress | Классическая PHP-тема (не block theme), ACF Pro, WordPress Studio (локальный стенд) |
| Деплой | Vercel (статичная сборка) |

## Структура

```text
.
├── docs/                          # прогресс, архитектура, история, roadmap
├── scripts/                       # сборка Pug/SCSS/JS и локальный preview-сервер
├── static/                        # источник вёрстки
│   ├── scss/                      # стили: base/components/sections
│   ├── js/                        # entry + modules (собираются в app.js)
│   ├── template-parts/pug/        # layouts/components/sections/pages
│   ├── images/, fonts/            # ассеты из Figma
│   └── css/, js/app.js, index.html   # генерируются сборкой, не редактируются напрямую
├── wordpress/greatjob/            # WordPress-тема
│   ├── acf-json/                  # ACF field groups (local JSON sync)
│   ├── inc/cpt/                   # регистрация custom post types
│   ├── inc/options-pages.php      # ACF Options Pages для Header/Footer
│   ├── template-parts/section/    # партиалы flexible-content секций
│   ├── assets/css/, assets/js/    # копии собранных static/css и static/js
│   └── header.php, footer.php, front-page.php, single-*.php, archive-*.php
├── vercel.json
└── package.json
```

## Команды (static/)

```powershell
npm install
npm run build       # Pug + SCSS + JS
npm run dev         # сборка + watch + локальный сервер на http://127.0.0.1:4173
npm run dev:open    # то же самое, сразу открывает браузер
npm run preview     # build + serve
```

Редактируются только исходники: `static/template-parts/pug`, `static/scss`, `static/js`. Файлы `static/css/style.css`, `static/js/app.js` и `static/index.html` генерируются командой `build` и в git не хранятся.

## WordPress-тема

`wordpress/greatjob/` — тема на классическом PHP (не Gutenberg block theme), требует активный **ACF Pro**.

- **Секции главной страницы** — один flexible-content филд `sections` (location: `page_type == front_page`), каждый layout соответствует партиалу в `template-parts/section/`.
- **ACF-поля** — через local JSON (`acf-json/`, фильтры в `inc/acf.php`). После правок в JSON-файле нужно нажать «Sync» в админке (Custom Fields → Field Groups).
- **Custom post types** (`inc/cpt/`): `greatjob_review` и `greatjob_pricing` — карточки без собственной страницы; `greatjob_service` — с архивом и отдельной страницей на каждую услугу.
- **Header/Footer** — не нативное меню WordPress, а ACF Options Pages (`inc/options-pages.php`): пункт «Header & Footer» с вкладками «Header»/«Footer», поддержка вложенных подменю.
- **Ассеты** — `assets/css/style.css` и `assets/js/app.js` являются копиями собранных файлов из `static/`; при правках вёрстки их нужно пересобрать и скопировать заново.

Полная архитектура, разобранные баги и их причины — в [docs/wordpress.md](docs/wordpress.md) и [docs/responsive-qa.md](docs/responsive-qa.md).

## Деплой

Статичная сборка (`static/`) деплоится на Vercel через `vercel.json`:

- `buildCommand`: `npm run build`
- `outputDirectory`: `static`

Vercel сам ставит зависимости и собирает Pug/SCSS/JS перед раздачей.

WordPress-тема деплоится вручную: `wordpress/greatjob/` копируется в `wp-content/themes/` целевого сайта, активируется, требует установленный и активированный плагин ACF Pro, после чего в админке нужно синхронизировать local JSON группы полей (Custom Fields → Field Groups → Sync).

## Документация

| Файл | Содержание |
| --- | --- |
| [docs/progress.md](docs/progress.md) | Текущий статус проекта |
| [docs/wordpress.md](docs/wordpress.md) | Архитектура WordPress/ACF-интеграции, найденные баги и их причины |
| [docs/responsive-qa.md](docs/responsive-qa.md) | Лог визуальных/адаптивных правок и фиксов |
| [docs/history.md](docs/history.md) | История разработки по этапам |
| [docs/roadmap.md](docs/roadmap.md) | Пройденные и оставшиеся этапы |
| [docs/figma.md](docs/figma.md) | Контекст макета в Figma |
| [docs/ui-system.md](docs/ui-system.md) | Токены, размеры секций, БЭМ-правила |

## Контекст макета

Источник: [GreatJob в Figma](https://www.figma.com/design/GvYjV98aVqGmfqyVZEjx9a/GreatJob?node-id=1-1100&m=dev). Desktop-макет: основной frame `1600×8002`, контентная колонка `1200 px`. Отдельных mobile/tablet frames в макете нет — адаптивные состояния собраны вручную.
