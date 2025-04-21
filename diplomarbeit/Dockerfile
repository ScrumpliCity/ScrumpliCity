# syntax=docker/dockerfile:1.7-labs

FROM node:23-slim@sha256:dfb18d8011c0b3a112214a32e772d9c6752131ffee512e974e59367e46fcee52 as build-stage
WORKDIR /app

COPY package*.json ./
RUN npm ci

COPY --exclude=nginx.conf . .
RUN npm run generate

FROM nginx:stable-alpine as production-stage
COPY --from=build-stage --link /app/dist /usr/share/nginx/html
COPY --link nginx.conf /etc/nginx/nginx.conf
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]