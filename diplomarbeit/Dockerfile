# syntax=docker/dockerfile:1.7-labs

FROM node:23-slim@sha256:581b092a3dc3bb258192b8d95d6aa2e598c068a32dcbcf86aab7d42df7b2b663 as build-stage
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