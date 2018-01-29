//@TODO save quiz data to localstore
const StoreData = {
    collectFormData() {
        return [];
    },

    saveData(name = 'formData', data = this.collectFormData()) {
        sessionStorage.setItem(name, JSON.stringify(data));
    },

    getData(name = 'formData') {
        if (!sessionStorage.getItem(name)) return {};
        const data = JSON.parse(sessionStorage.getItem(name));

        return data;
    },

    getProp(prop) {
        const data = this.getData();
        return data[prop];
    },

    setProp(prop, val) {
        const data = this.getData();
        data[prop] = val;
    }
};

export default StoreData;