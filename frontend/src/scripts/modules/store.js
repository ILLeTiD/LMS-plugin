//@TODO save quiz data to localstore
class StoreData {
    constructor(name) {
        this.name = name;
    }

    saveData(data, name = this.name) {
        sessionStorage.setItem(this.name, JSON.stringify(data));
    }

    getData(name = this.name) {
        if (!sessionStorage.getItem(name)) return [];
        const data = JSON.parse(sessionStorage.getItem(name));

        return data;
    }

    getProp(prop) {
        const data = this.getData();
        return data[prop];
    }

    setProp(prop, val) {
        const data = this.getData();
        data[prop] = val;
    }
}

export default StoreData;