/**
 * Прослойка для взаимодействия с API
 */
import {projects as API} from '@/api/RestAPI'

/**
 * Трансформер
 */
// import ProjectTransformer from '@/transformers/ProjectTransformer'

/**
 * Обработчик ошибок
 */
// import {APIErrorHandler} from '@/utils/ErrorHandlers'

/**
 * Типы мутаций
 */
import {
  GOT_PROJECTS,
  GOT_PROJECTS_REQUEST_PROCESSING,
  GOT_PROJECTS_REQUEST_COMPLETION,

  GOT_PROJECT,
  GOT_PROJECT_REQUEST_PROCESSING,
  GOT_PROJECT_REQUEST_COMPLETION,

  GOT_PROJECT_CREATED,
  GOT_PROJECT_UPDATED,
  GOT_PROJECT_DELETED,

  GOT_PROJECT_CHART_STATISTIC,
  GOT_PROJECT_TABLE_STATISTIC
} from './types'

const GOT_REQUEST_PROCESSING = 'GOT_REQUEST_PROCESSING'
const GOT_REQUEST_COMPLETION = 'GOT_REQUEST_COMPLETION'

/**
 * Типы действий
 */
import {
  FETCH_PROJECT_CHART_STATISTIC,
  FETCH_PROJECT_TABLE_STATISTIC
} from './types'

const getError = (response) => {
  return response && response.error ? response.error : (response.errors ? Object.values(response.errors) : response)
}

export default {

  /**
   * Получение массива всех проектов с сервера
   * @returns {Promise}
   */
  fetchProjects: ({ commit }, options) => {
    return new Promise((resolve, reject) => {
      commit('GOT_PROJECTS_REQUEST_PROCESSING')
      API.projects(options)
        .then(({ data: projects, meta: pagination }) => {
          commit(GOT_PROJECTS, {
            projects: projects,//new ProjectTransformer().collection(projects),
            pagination
          })
          resolve()
        })
        .catch((error) => reject(getError(error)))
        .finally(() => {
          commit('GOT_PROJECTS_REQUEST_COMPLETION')
        })
    })
  },

  /**
   * Получение проекта по ID
   * @returns {Promise}
   */
  fetchProject: ({ commit }, id) => {
    return new Promise((resolve, reject) => {
      API.project(id)
        .then(({ data: project }) => {
          commit(GOT_PROJECT, project)//new ProjectTransformer().entity(project))
          resolve()
        })
        .catch((error) => reject(getError(error)))
    })
  },

  /**
   * Создание проекта
   * @param {Object} newProject
   * @returns {Promise}
   */
  downloadRepo: ({ commit }, newProject) => {
    return new Promise((resolve, reject) => {
      API.create(newProject)
        .then(({ data: project }) => {
          commit(GOT_PROJECT_CREATED, project)//new ProjectTransformer().entity(project))
          resolve()
        })
        .catch((error) => reject(getError(error)))
    })
  }
}
