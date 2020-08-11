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

export function getLanguageInfo(code, successCallback, errorCallback) {
    return axios
        .get('https://restcountries.eu/rest/v2/lang/'+code)
        .then(successCallback)
        .catch(errorCallback);
}

export function getSentiment(data, successCallback, errorCallback) {
    return axios
        .post('/api/sentiment', data)
        .then(successCallback)
        .catch(errorCallback);
}

export function getNeighbouring(data, successCallback, errorCallback) {
    return axios
        .post('/api/neighbouring', data)
        .then(successCallback)
        .catch(errorCallback);
}

export function getConceptGraph(data, successCallback, errorCallback) {
    return axios
        .post('/api/concept',data)
        .then(successCallback)
        .catch(errorCallback);
}
