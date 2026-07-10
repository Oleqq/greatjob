# Scroll animation plan

Status: implemented for the static landing page with native IntersectionObserver and staggered reveal.

Анимации не подключаются на этапе базовой верстки, но являются обязательным следующим этапом.

## Поведение

- секции появляются через общий reveal при входе в viewport;
- заголовок секции появляется первым;
- подзаголовок/описание — с небольшой задержкой;
- карточки появляются stagger-каскадом слева направо и сверху вниз;
- текст внутри карточек получает отдельный fade/slide после поверхности карточки;
- hero получает отдельную entrance-анимацию только при первом открытии страницы;
- FAQ tabs и accordion получают мягкие state-transition;
- на tablet/mobile сохраняется reveal-логика, но уменьшаются расстояния и задержки;
- при `prefers-reduced-motion: reduce` все переходы отключаются или становятся мгновенными.

## План технической реализации

1. Добавить универсальные `data-reveal`, `data-reveal-item` и `data-reveal-delay`.
2. Подключить один native JS-модуль на `IntersectionObserver`.
3. Добавить модификаторы направления: `reveal--up`, `reveal--left`, `reveal--right`, `reveal--scale`.
4. Настроить stagger через CSS custom properties, без библиотек.
5. Проверить поведение на desktop, tablet и mobile.
