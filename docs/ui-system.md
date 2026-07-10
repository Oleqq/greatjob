# UI system

Рабочая база для повторного использования на следующих страницах. Значения ниже сверены с Figma frame `1:1100`; hover-состояния — единое правило реализации для интерактивных карточек, потому что отдельные hover-frames в макете не выделены.

## Базовые токены

| Токен | Значение |
| --- | --- |
| Контентный контейнер | `1200 px` |
| Desktop outer margin | `200 px` при ширине `1600 px` |
| Header | `1200×52 px`, верхний отступ `24 px` |
| Основной gap секций | `24 px` |
| H1 | Cygre ExtraBold, `68 px`, line-height `1.1` |
| H2 | Cygre ExtraBold, `48 px`, line-height `1.1` |
| H3 | Cygre ExtraBold, `28 px`, line-height `1.1` |
| H4 | Cygre ExtraBold, `24 px`, line-height `1.2` |
| Body | Inter Regular, `16 px`, line-height `1.2` |
| Body semibold | Inter Semi Bold, `16 px`, line-height `1.2` |
| Small | Inter Regular, `14 px`, line-height `1.2` |
| Hero / large cards radius | `20 px` |
| CTA radius | `15 px` |
| Section vertical rhythm | `90 px` top + `90 px` bottom |

Fluid values are implemented through `adaptive-font()` and `adaptive-value()` in `static/scss/base/_mixins.scss`. Fixed values are reserved for reference geometry, asset sizes and hard constraints; typography, section padding and responsive gaps should use the mixins where possible.

## БЭМ-правило

Новые элементы добавляются как самостоятельные блоки или элементы блока:

```text
.header
.header__nav
.header__link
.header-menu
.header-menu__link
.button
.button--dark
.hero
.hero__title
.hero-stat
.hero-stat__label
```

Состояния оформляются модификаторами и служебными классами: `.button--dark`, `.button--light`, `.nav-pill.is-active`, `.faq-item[open]`, `body.header-menu-is-open`.

## Секции и карточки

- Header: nav gap `56 px`, Telegram `52×52 px`, CTA `300×52 px`.
- Hero: `1200×709 px`, radius `20 px`; внутренний offset `114/70 px`; stats снизу — `230 px`, `432 px`, `262 px`, gap `24 px`, padding `32 px`.
- Problems: flex-wrap с карточками по `384 px`, gap `24 px` по горизонтали и `32 px` по вертикали; иконка `56×56 px`; gap иконка/текст `16 px`; последняя строка центрируется.
- Metrics: три колонки по `384 px`, две строки по `220 px`, gap `24 px`; текстовый блок с отступом `32 px`.
- Metrics: левая и правая колонки состоят из карточек `220 px`, центральная карточка — `464 px`; графика живёт в `.metrics-card__art` и заменяется через именованные `data-svg-slot`.
- Metrics на tablet/mobile с `max-width: 900px` переходят в одну последовательную колонку, чтобы рядом с карточками не появлялось пустого пространства.
- Steps: три карточки `384×368 px`, gap `24 px`, внутренний padding `32 px`.
- Reviews: карточка `384×496 px`, внутренний padding `24 px`; рейтинг — пять элементов по `24 px`; нижняя мета-строка отделена отзывающейся линией.
- Pricing: карточки `384×846 px`; внешняя область `24 px`; список внутри `336×579 px`; CTA `336×52 px` снизу.
- Services: masonry-сетка с карточками шириной `282 px` и широкими вариантами `588 px`; стандартный внутренний padding `24 px`; чек-иконка `20×20 px`, gap до текста `8 px`.
- FAQ: слева три tab-кнопки `220×52 px`, gap `8 px`; справа список шириной `932 px`; вопросы имеют высоту `77 px`, раскрытый вопрос — `127 px`.

## Интерактивные состояния

- карточки: `transform: translateY(-4px)` и мягкая тень при hover;
- CTA и icon buttons: небольшой подъём `-2 px` и изменение цвета;
- FAQ tabs: светлый фон по умолчанию, accent-фон у `.is-active`, усиление цвета на hover;
- accordion: раскрытие через нативный `details`, плюс меняется на минус, остальные элементы закрываются JS-модулем;
- mobile menu: полноэкранный fixed-layer, выезд сверху при открытии и возврат вниз при закрытии.
