# Manticore Search Prometheus Exporter

Version: 6.3.6.0

### Installation

1) Clone the repository:
```bash
git clone git@github.com:manticoresoftware/manticoresearch-prometheus.git
cd manticoresearch-prometheus
```

2) Update the Manticore Search host and port in `deployment.yaml`:
```
env:
  - name: MANTICORE_HOST
    value: "{YOUR HOST}"
  - name: MANTICORE_PORT
    value: "{YOUR PORT}"
``` 
3) Deploy the configuration:
```kubernetes helm
kubectl -n {namespace} apply -f deployment.yaml
```

Once deployed, the exporter will automatically integrate with Prometheus. No additional configuration is needed on the Prometheus side to enable scraping.

If you're using the [Manticore Search Helm Chart](https://github.com/manticoresoftware/manticoresearch-helm), the exporter is already included, so no extra setup is required.

### Support Matrix

The table below shows the compatibility matrix for the exporter and Manticore Search versions. Note that some metrics may not be available or may display incorrect data if the versions are not aligned. To avoid such issues, use the same version of the exporter as your Manticore Search.

| Exporter version | Min Manticore version | Max Manticore version |
|------------------|-----------------------|-----------------------|
| 3.6.0.0          | 2.6.2                 | 6.3.2                 |
| 3.6.0.1          | 2.6.2                 | 6.3.2                 |
| 5.0.0.0          | 2.6.2                 | 6.3.2                 |
| 5.0.0.2          | 2.6.2                 | 6.3.2                 |
| 5.0.0.4          | 2.6.2                 | 6.3.2                 |
| 5.0.2.0          | 2.6.2                 | 6.3.2                 |
| 5.0.2.1          | 2.6.2                 | 6.3.2                 |
| 5.0.2.2          | 2.6.2                 | 6.3.2                 |
| 5.0.2.3          | 2.6.2                 | 6.3.2                 |
| 5.0.2.4          | 2.6.2                 | 6.3.2                 |
| 5.0.2.5          | 2.6.2                 | 6.3.2                 |
| 6.2.12.0         | 2.6.2                 | 6.3.2                 |
| 6.2.13.0         | 2.6.2                 | 6.3.2                 |
| 6.2.13.1         | 2.6.2                 | 6.3.2                 |
| 6.3.0.0          | 2.6.2                 | 6.3.2                 |
| 6.3.0.1          | 3.2.0                 | 6.3.2                 |
| 6.3.2.0          | 3.2.0                 | 6.3.2                 |
| 6.3.6.0          | 6.3.6                 | 6.3.7                 |
