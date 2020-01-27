import HTTPClient from '@/api/HTTPClient'
import { PROJECTS_ENDPOINT } from '@/api/Routes'

export default class ProjectsAPI extends HTTPClient {

    constructor () {
        super()
    }

    projects (params = null) {
        return this.get(`${PROJECTS_ENDPOINT}${this.urlParameters(params)}`)
    }

    project (id) {
        return this.get(`${PROJECTS_ENDPOINT}/${id}`)
    }

    create() {
        return this.post(`${PROJECTS_ENDPOINT}`)
    }
}
