FROM node:23-slim@sha256:dfb18d8011c0b3a112214a32e772d9c6752131ffee512e974e59367e46fcee52 AS build-stage
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
ARG SCRUMPLICITY_LARAVEL_API_URL
ENV SCRUMPLICITY_LARAVEL_API_URL=${SCRUMPLICITY_LARAVEL_API_URL}
RUN npm run build

FROM node:23-alpine@sha256:86703151a18fcd06258e013073508c4afea8e19cd7ed451554221dd00aea83fc AS production-stage
COPY --link --from=build-stage /app/.output /app
WORKDIR /app
ENV NITRO_PORT=80
EXPOSE 80
CMD ["node", "server/index.mjs"]