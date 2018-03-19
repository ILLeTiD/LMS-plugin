//@TODO save quiz data to localstore
class StoreData {
    constructor(name) {
        this.name = name;
    }

    saveData(data, name = this.name) {
        localStorage.setItem(this.name, JSON.stringify(data));
    }

    getData(name = this.name) {
        if (!localStorage.getItem(name)) return [];
        const data = JSON.parse(localStorage.getItem(name));

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