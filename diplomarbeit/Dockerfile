# syntax=docker/dockerfile:1.7-labs

FROM node:25-slim@sha256:2688bfed319481b4e9c7af4d874736777c932516b55bc1b087cc4fafcbca3e5d as build-stage
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