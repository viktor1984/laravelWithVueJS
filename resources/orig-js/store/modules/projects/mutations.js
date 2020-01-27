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
  GOT_PROJECT_SELECTED,
  GOT_PROJECT_TABLE_STATISTIC, GOT_PROJECT_CHART_STATISTIC
} from './types'

export default {

  /*************************************************************/
  /********************** MAIN MUTATIONS ***********************/
  /*************************************************************/

  [GOT_PROJECTS]: (state, { projects, pagination }) => {
    state.projects = projects
    state.freeProjects = projects.filter(project => !project.landingType && !project.premium)
    state.landingProjects = projects.filter(project => project.landingType && !project.premium)
    state.premiumProjects = projects.filter(project => project.premium)
    state.pagination = pagination
    // state.projectsNeedFetch = false
  },

  [GOT_PROJECT]: (state, project) => {
    state.project = project
    state.projectNeedFetch = false
  },

  [GOT_PROJECT_CHART_STATISTIC]: (state, chartStatistic) => {
    state.projectChartStatistic = chartStatistic
  },

  [GOT_PROJECT_TABLE_STATISTIC]: (state, statisticTable) => {
    state.projectStatistic = statisticTable
  },

  [GOT_PROJECT_CREATED]: (state, newProject) => {
    state.projects.unshift(newProject)
    state.project = newProject
  },

  [GOT_PROJECT_UPDATED]: (state, updatedProject) => {
    const projectIndex = state.projects.indexOf(state.projects.find(project => project.id === updatedProject.id))

    state.projects[projectIndex] = updatedProject
    state.project = updatedProject
  },

  [GOT_PROJECT_DELETED]: (state, { id }) => {
    const projectIndex = state.projects.indexOf(state.projects.find(project => project.id === id))

    state.projects.splice(projectIndex, 1)
  },

  [GOT_PROJECT_SELECTED]: (state, id) => {
    state.project = state.projects.find(project => project.id === id)
  },

  /*************************************************************/
  /*************************** OTHER ***************************/
  /*************************************************************/

  'GOT_PROJECTS_REQUEST_PROCESSING': (state) => {
    state.projectsIsFetching = true
  },

  'GOT_PROJECTS_REQUEST_COMPLETION': (state) => {
    state.projectsIsFetching = false
  },

  [GOT_PROJECT_REQUEST_PROCESSING]: (state) => {
    state.projectIsFetching = true
  },

  [GOT_PROJECT_REQUEST_COMPLETION]: (state) => {
    state.projectIsFetching = false
  },

  // Получены данные для графика статистики по проекту
  [GOT_PROJECT_CHART_STATISTIC]: (state, chartData) => {
    state.projectChartStatistic = chartData
  },

  // Получена таблица со статистикой по проекту
  [GOT_PROJECT_TABLE_STATISTIC]: (state, statisticTable) => {
    state.projectTableStatistic = statisticTable
  },

  // Удалить из стейта всю информацию по проектам
  'ERASE_PROJECTS_DATA': state => {
    state.projects = []
    state.projectsNeedFetch = true
    state.project = null
    state.projectNeedFetch = true
    state.projectTableStatistic = null
    state.projectChartStatistic = null
  },

  // Записать список тематик проекта в стейт
  'GET_THEMATICS': (state, thematics) => {
    state.thematics = thematics
  },

  // Записать список доменов для лендинга в стейт
  'GET_DOMAINS': (state, domains) => {
    state.domains = domains
  },

  // Записать список доменов для лендинга в стейт
  'GET_LANDINGS': (state, landings) => {
    state.landings = landings
  },

  // Проверка, установлены ли у пользователя на сайте наши файлы
  'PROJECT_SETUP_FILES_CHECKING_PROCESSING': state => {
    state.projectSetupFilesChecking = true
  },
  'PROJECT_SETUP_FILES_CHECKING_COMPLETED': state => {
    state.projectSetupFilesChecking = false
  },
  'PROJECT_SETUP_FILES_CHECKING_SUCCESS': state => {
    state.projectSetupFilesSuccess = true
  },
  'PROJECT_SETUP_FILES_CHECKING_FAIL': (state, errors) => {
    state.projectSetupFilesSuccess = false
    state.projectSetupFilesErrors = errors
  },
  'PROJECT_SETUP_FILES_CHECKING_CLEAR': (state) => {
    state.projectSetupFilesChecking = false
    state.projectSetupFilesSuccess = false
    state.projectSetupFilesErrors = []
  }
}
