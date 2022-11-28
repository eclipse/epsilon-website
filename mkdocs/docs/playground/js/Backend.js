class Backend {

    services = {};

    configure() {
        var xhr = new XMLHttpRequest();
        var url = "backend.json";
        xhr.open("GET", url, false);
        xhr.send();
        if (xhr.status === 200) {
            var json = JSON.parse(xhr.responseText);
            for (const service of json.services) {
                this.services[service.name] = service.url;
            }
        }
    }

    getRunEpsilonService() {
        return this.services["RunEpsilonFunction"];
    }

    getFlexmiToPlantUMLService() {
        return this.services["FlexmiToPlantUMLFunction"];
    }

    getEmfaticToPlantUMLService() {
        return this.services["EmfaticToPlantUMLFunction"];
    }

    getShortURLService() {
        return this.services["ShortURLFunction"];
    }
}

export { Backend };