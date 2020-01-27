export default {
  findProject: state => id => state.projects.find(project => project.id === id),
  currentProject: state => state.project,
  currentProjectName: state => {
    if (state.project && (state.project.name || state.project.domain)) {
      return (state.project.name || state.project.domain)
    }
    return null
  },
  // Массив id всех непремиумных проектов. Используется для запроса общей статистики.
  allFreeProjectIds: state => {
    return state.freeProjects.map(project => project.id)
  }
}
