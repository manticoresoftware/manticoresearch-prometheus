# Manticore Search Prometheus Exporter

Version: 6.3.2.0

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
