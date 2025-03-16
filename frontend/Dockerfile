FROM node:23-slim@sha256:581b092a3dc3bb258192b8d95d6aa2e598c068a32dcbcf86aab7d42df7b2b663 AS build-stage
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
ARG SCRUMPLICITY_LARAVEL_API_URL
ENV SCRUMPLICITY_LARAVEL_API_URL=${SCRUMPLICITY_LARAVEL_API_URL}
RUN npm run build

FROM node:23-alpine@sha256:6eae672406a2bc8ed93eab6f9f76a02eb247e06ba82b2f5032c0a4ae07e825ba AS production-stage
COPY --link --from=build-stage /app/.output /app
WORKDIR /app
ENV NITRO_PORT=80
EXPOSE 80
CMD ["node", "server/index.mjs"]