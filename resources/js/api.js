import axios from 'axios'

export function getUsers(successCallback, errorCallback) {
    return axios
        .get('/api/users')
        .then(successCallback)
        .catch(errorCallback);
}

export function getLanguage(data, successCallback, errorCallback) {
    return axios
        .post('/api/language',data)
        .then(successCallback)
        .catch(errorCallback);
}
