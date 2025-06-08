# WIAM-API

**Test task**  
Проект построен на Yii2, PostgreSQL и Redis, разворачивается в Docker-среде.

## 🚀 Быстрый старт

### 🔧 Требования

- Docker
- Docker Compose
- Git

### ⚙️ Установка

1. Клонировать репозиторий:
   ```
   git clone https://github.com/MikhailShapshay/WIAM-API.git
   cd WIAM-API
   ```
2. Построить и запустить контейнеры:
   ```
   docker-compose up -d --build
   ```

3. Установить зависимости внутри контейнера:
    ```
    docker-compose exec php composer install
    ```

4. Выполнить миграции (опционально):
   ```
   docker-compose exec php php yii migrate
   ```
5. Проект будет доступен по адресу:
   ```
   http://localhost
   ```
### 🐘 Используемые технологии
- PHP 8.3 (FPM)
- Yii2 Framework
- PostgreSQL 14
- Redis 7
- Nginx (alpine)
- Supervisor (для php-fpm и yii queue)
- Docker / Docker Compose

### 📂 Структура
   ```
.
├── _docker/                  # Dockerfile, конфиги nginx, supervisor и php.ini
├── src/app/                  # Исходный код приложения (Yii2)
├── docker-compose.yml        # Конфигурация docker-compose
└── README.md                 # Инструкция по запуску проекта
   ```

### ⏱ Время выполнения
**1–2 часа**

Время затрачено в основном на:

- настройку окружения и docker-инфраструктуры,

- конфигурацию Supervisor для управления php-fpm и yii queue,

- установку зависимостей и запуск проекта.
