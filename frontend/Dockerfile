FROM node:20-slim@sha256:ec35a66c9a0a275b027debde05247c081f8b2f0c43d7399d3a6ad5660cee2f6a AS build-stage
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
ARG SCRUMPLICITY_LARAVEL_API_URL
ENV SCRUMPLICITY_LARAVEL_API_URL=${SCRUMPLICITY_LARAVEL_API_URL}
RUN npm run build

FROM node:20-alpine@sha256:c13b26e7e602ef2f1074aef304ce6e9b7dd284c419b35d89fcf3cc8e44a8def9 AS production-stage
COPY --link --from=build-stage /app/.output /app
WORKDIR /app
ENV NITRO_PORT=80
EXPOSE 80
CMD ["node", "server/index.mjs"]