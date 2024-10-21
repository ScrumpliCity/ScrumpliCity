FROM node:lts-alpine as build-stage
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

FROM node:lts-alpine as production-stage
COPY --from=build-stage /app/dist /app
WORKDIR /app
COPY nginx.conf /etc/nginx/nginx.conf
ENV NITRO_PORT=80
EXPOSE 80
CMD ["node", ".output/server/index.mjs"]