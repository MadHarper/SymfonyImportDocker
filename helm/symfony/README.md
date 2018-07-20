Build the PHP and Nginx Docker images:
```
docker build -t gcr.io/symfony-4-skeleton-docker/php -t gcr.io/symfony-4-skeleton-docker/php:latest symfony
docker build -t gcr.io/symfony-4-skeleton-docker/nginx -t gcr.io/symfony-4-skeleton-docker/nginx:latest -f symfony/Dockerfile.nginx symfony
docker build -t gcr.io/symfony-4-skeleton-docker/varnish -t gcr.io/symfony-4-skeleton-docker/varnish:latest -f symfony/Dockerfile.varnish symfony
```
Push your images to your Docker registry, example with Google Container Registry:
```
gcloud docker -- push gcr.io/symfony-4-skeleton-docker/php
gcloud docker -- push gcr.io/symfony-4-skeleton-docker/nginx
gcloud docker -- push gcr.io/symfony-4-skeleton-docker/varnish
```

Deploy your API to the container:

```
helm install ./symfony/helm/symfony --namespace=symfony --name symfony \
    --set php.repository=gcr.io/symfony-4-skeleton-docker/php \
    --set nginx.repository=gcr.io/symfony-4-skeleton-docker/nginx \
    --set secret=MyAppSecretKey \
    --set postgresql.postgresPassword=symfony \
    --set postgresql.persistence.enabled=true \
    --set corsAllowUrl='^https?://[a-z\]*\.mywebsite.com$'
```
