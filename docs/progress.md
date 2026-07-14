# Progress

## Сделано

- [x] Создан чистый static-first каталог проекта.
- [x] Подключен стек `Pug + SCSS + modular native JS`.
- [x] Добавлена сборка Pug, SCSS и JS через Node.js scripts.
- [x] Добавлен локальный preview-сервер.
- [x] Подготовлен модульный каркас основных секций страницы.
- [x] Добавлена базовая адаптивная сетка desktop / tablet / mobile.
- [x] Добавлена документация этапа и контекст Figma.
- [x] Проверены `npm install`, `npm run build` и HTTP preview всех основных файлов.
- [x] Добавлены локальные `Cygre ExtraBold` и `Inter`, а также ассеты header/hero из Figma.
- [x] Header и hero переведены на БЭМ-классы и собраны по desktop-макету.
- [x] Добавлено полноэкранное адаптивное burger-меню с анимацией открытия и закрытия.
- [x] Сверстана секция «Решаем ваши проблемы» с Figma-иконками и единым ритмом секций `90/90 px`.
- [x] Добавлена fluid-система `adaptive-font()`, `adaptive-value()` и `section-space()` на базе `clamp()`.
- [x] Сверстан «План действий в цифрах»: responsive-структура карточек и пять SVG-slot-областей для графики.
- [x] Зафиксирован отдельный план обязательных scroll-reveal/stagger-анимаций.
- [x] Подключены пользовательские SVG-файлы metrics из `static/images/metrics`.
- [x] Сверстана секция «Три шага до предложения о работе» с локальными SVG-ассетами.
- [x] Сверстаны секции «Отзывы» (Swiper.js), «Тарифы», «Дополнительные услуги», «Telegram CTA», FAQ и footer.
- [x] Подключена общая scroll-reveal/stagger-анимация секций через native `IntersectionObserver`.
- [x] Проведён пакет responsive-QA правок по desktop/tablet/mobile.
- [x] Настроен деплой статичной сборки на Vercel (`vercel.json`, `buildCommand`/`outputDirectory`).

## Сейчас

Вся главная страница и Header/Footer перенесены в WordPress-тему `greatjob` и проверены на локальном стенде Studio: flexible content + ACF local JSON + 3 CPT (Отзывы/Тарифы без своей страницы, Услуги — с архивом и single) + ACF Options Pages для Header/Footer (с поддержкой подменю, без нативных меню WordPress). Подробности по каждой секции — в [docs/wordpress.md](wordpress.md).

## Не сделано

- [ ] Финальный текстовый и ссылочный контент (реальные CTA/Telegram/соцсети вместо временных значений).
- [ ] Финальная pixel-сверка контрольных ширин с Figma.
