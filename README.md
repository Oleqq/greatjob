# GreatJob

Статичная landing page GreatJob перед дальнейшей интеграцией в WordPress через ACF Pro.

## Стек

- Pug — исходники HTML;
- SCSS — стили и секционные модули;
- native modular JavaScript — поведение меню и FAQ;
- esbuild — сборка JS в один browser bundle;
- Node.js scripts — единая сборка и локальный preview.

## Структура

```text
.
├── docs/                         # короткие рабочие заметки
├── scripts/                      # Pug, SCSS, JS и preview-сервер
├── static/
│   ├── css/                      # собранный CSS
│   ├── images/                   # ассеты из Figma
│   ├── js/                       # entry, modules и собранный bundle
│   ├── scss/                     # исходники SCSS
│   ├── template-parts/pug/       # layout, components, sections, pages
│   └── index.html                # сгенерированный preview
└── package.json
```

Редактируются только исходники в `static/template-parts/pug`, `static/scss` и `static/js`. Файлы в `static/css`, `static/js/app.js` и `static/index.html` генерируются сборкой.

## Команды

```powershell
npm install
npm run build
npm run dev
npm run dev:open
npm run preview
```

`npm run dev` собирает проект, запускает наблюдение за Pug/SCSS/JS и поднимает локальный сервер на `http://127.0.0.1:4173`.

## Контекст макета

Источник: [GreatJob в Figma](https://www.figma.com/design/GvYjV98aVqGmfqyVZEjx9a/GreatJob?node-id=1-1100&m=dev).

Desktop-макет: основной frame `1600×8002`, контентная колонка `1200 px`; мобильная и tablet-версии будут адаптированы вручную по мере реализации секций.
