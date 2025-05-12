FROM node:24-slim@sha256:f403f3b5054f8f35ebe8dd167e0c608945a8fd992f3d278d2a8652b58b80dc92 AS build-stage
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
ARG SCRUMPLICITY_LARAVEL_API_URL
ENV SCRUMPLICITY_LARAVEL_API_URL=${SCRUMPLICITY_LARAVEL_API_URL}
RUN npm run build

FROM node:24-alpine@sha256:37712740dc486f179b9540be1c6703cef3f805ea932573a007db748b71189afe AS production-stage
COPY --link --from=build-stage /app/.output /app
WORKDIR /app
ENV NITRO_PORT=80
EXPOSE 80
CMD ["node", "server/index.mjs"]