# Metrics SVG slots

Графические части секции «План действий в цифрах» подключаются автоматически из этого каталога через слой `.metrics-card__art`. Имена файлов должны совпадать с `data-svg-slot`.

В Pug оставлены именованные точки вставки:

- `metrics-resume-art`
- `metrics-vacancies-art`
- `metrics-companies-art`
- `metrics-support-art`
- `metrics-strategy-art`

Для обычной декоративной SVG-графики используется `<img src="./images/metrics/file.svg" alt="" aria-hidden="true">`. Inline SVG нужен только для управления отдельными цветами, частями изображения или анимацией.
