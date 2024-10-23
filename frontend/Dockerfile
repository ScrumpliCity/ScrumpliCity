FROM node:lts-alpine as build-stage
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
ARG SCRUMPLICITY_LARAVEL_API_URL
ENV SCRUMPLICITY_LARAVEL_API_URL=${SCRUMPLICITY_LARAVEL_API_URL}
RUN npm run build

FROM node:lts-alpine as production-stage
COPY --link --from=build-stage /app/dist /app
WORKDIR /app
ENV NITRO_PORT=80
EXPOSE 80
CMD ["node", ".output/server/index.mjs"]