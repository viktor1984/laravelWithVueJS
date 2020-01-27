import Vuex from 'vuex'
/**
 * Логгер
 */
import createLogger from 'vuex/dist/logger'

/**
 * Модули хранилища
 */
import projects from '@/store/modules/projects'

const GOT_REQUEST_PROCESSING = 'GOT_REQUEST_PROCESSING'
const GOT_REQUEST_COMPLETION = 'GOT_REQUEST_COMPLETION'
const GOT_PRELOADER_ACTIVATED = 'GOT_PRELOADER_ACTIVATED'
const GOT_PRELOADER_DEACTIVATED = 'GOT_PRELOADER_DEACTIVATED'

const DEBUG_MODE = process.env.NODE_ENV !== 'production'

/**
 * Создание экземпляра хранилища
 */
export default new Vuex.Store({
    modules: {
        projects
    },
    state: {
        isPending: false,
        isPreloaderDisplayed: false
    },
    actions: {
        activatePreloader: ({ commit }) => commit('GOT_PRELOADER_ACTIVATED'),
        deactivatePreloader: ({ commit }) => commit('GOT_PRELOADER_DEACTIVATED')
    },
    mutations: {
        [GOT_REQUEST_PROCESSING]: state => state.isPending = true,
        [GOT_REQUEST_COMPLETION]: state => state.isPending = false,
        [GOT_PRELOADER_ACTIVATED]: state => state.isPreloaderDisplayed = true,
        [GOT_PRELOADER_DEACTIVATED]: state => state.isPreloaderDisplayed = false
    },
    getters: {
       isPreloaderDisplayed: state => state.isPreloaderDisplayed
    },
    strict: DEBUG_MODE,
    plugins: DEBUG_MODE ? [createLogger()] : []
})
