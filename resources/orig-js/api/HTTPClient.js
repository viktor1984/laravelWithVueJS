import axios from 'axios'
import { REST_API_LOCATION } from '@/api/Routes'

export default class HTTPClient {

  constructor (url = null) {
    this.API_URL = url || REST_API_LOCATION
  }

  submitRequest (requestType, endpoint, data = null) {
    const url = this.API_URL + endpoint
console.log('url');
console.log(this.API_URL);
    return new Promise((resolve, reject) => {
      axios[requestType](url, data)
        .then(response => resolve(response.data))
        .catch(({ response }) => response ? reject(response.data) : reject())
    })
  }

  get (endpoint) {
    return this.submitRequest('get', endpoint)
  }

  post (endpoint, data = null) {
    return this.submitRequest('post', endpoint, data)
  }

  put (endpoint, data = null) {
    return this.submitRequest('put', endpoint, data)
  }

  patch (endpoint, data = null) {
    return this.submitRequest('patch', endpoint, data)
  }

  delete (endpoint) {
    return this.submitRequest('delete', endpoint)
  }

  urlParameters (params) {
    if (!params) return ''

    const keys = Object.keys(params),
      parameterStrings = keys
        .filter(key => !!params[key])
        .map(key => `${key}=${params[key]}`)

    return parameterStrings.length === 0 ? '' : `?${parameterStrings.join('&')}`
  }
}
