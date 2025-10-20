FROM node:25-slim@sha256:2688bfed319481b4e9c7af4d874736777c932516b55bc1b087cc4fafcbca3e5d AS build-stage
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
ARG SCRUMPLICITY_LARAVEL_API_URL
ENV SCRUMPLICITY_LARAVEL_API_URL=${SCRUMPLICITY_LARAVEL_API_URL}
RUN npm run build

FROM node:25-alpine@sha256:809972647175c30a4c7763d3e6cc064dec588972af57e540e5a6f27442bb0845 AS production-stage
COPY --link --from=build-stage /app/.output /app
WORKDIR /app
ENV NITRO_PORT=80
EXPOSE 80
CMD ["node", "server/index.mjs"]