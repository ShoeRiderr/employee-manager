import axios from "axios";

const urlBase = "/api/companies";

export async function getAll() {
    return axios.get(urlBase);
}

export async function store(data) {
    return axios.post(urlBase, data);
}
