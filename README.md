# Manticore Search Prometheus Exporter

Version: 6.3.6.0

### Installation

1) Clone the repository:
```bash
git clone git@github.com:manticoresoftware/manticoresearch-prometheus.git`
cd manticoresearch-prometheus
```

2) Specify Manticore Search host and port in `deployment.yaml`
```
env:
  - name: MANTICORE_HOST
    value: "{YOUR HOST}"
  - name: MANTICORE_PORT
    value: "{YOUR PORT}"
``` 
3) Apply the deployment: 

```kubernetes helm
kubectl -n {namespace} apply -f deployment.yaml
```

The exporter will integrate with your Prometheus automatically, you don't need to configure scaping it from the Prometheus' side.

The exporter is used by [Manticore Search Helm Chart](https://github.com/manticoresoftware/manticoresearch-helm), no need to setup it additionally.

### Support Matrix

The current matrix indicates general support. Some metrics may be unavailable or display incorrect information. To avoid these issues, we recommend using the same exporter version as the Manticore Search version.

| Exporter version | Min MS version | Max MS version |
|------------------|----------------|----------------|
| 3.6.0.0          | 2.6.2          | 6.3.2          |
| 3.6.0.1          | 2.6.2          | 6.3.2          |
| 5.0.0.0          | 2.6.2          | 6.3.2          |
| 5.0.0.2          | 2.6.2          | 6.3.2          |
| 5.0.0.4          | 2.6.2          | 6.3.2          |
| 5.0.2.0          | 2.6.2          | 6.3.2          |
| 5.0.2.1          | 2.6.2          | 6.3.2          |
| 5.0.2.2          | 2.6.2          | 6.3.2          |
| 5.0.2.3          | 2.6.2          | 6.3.2          |
| 5.0.2.4          | 2.6.2          | 6.3.2          |
| 5.0.2.5          | 2.6.2          | 6.3.2          |
| 6.2.12.0         | 2.6.2          | 6.3.2          |
| 6.2.13.0         | 2.6.2          | 6.3.2          |
| 6.2.13.1         | 2.6.2          | 6.3.2          |
| 6.3.0.0          | 2.6.2          | 6.3.2          |
| 6.3.0.1          | 3.2.0          | 6.3.2          |
| 6.3.2.0          | 3.2.0          | 6.3.2          |
| 6.3.2.0          | 6.3.6          | 6.3.6          |