<template>
  <!-- Main application container -->
  <v-app id="application">

    <!-- Transition -->
    <v-slide-x-reverse-transition mode="out-in">

      <!-- Page view -->
      <div class="pushex">

        <!-- Application toolbar -->
        <!--<application-toolbar/>-->

        <!-- Page content -->
        <v-content>

          <!-- Content container -->
          <v-container class="pushex__content">

            <!-- Router view transition -->
            <v-slide-x-reverse-transition mode="out-in">
              <router-view/>
            </v-slide-x-reverse-transition>
          </v-container>
        </v-content>

      </div>
    </v-slide-x-reverse-transition>
  </v-app>
</template>

<script>
  // import ApplicationToolbar from '@/components/Toolbar'
  // import ApplicationInnerNavigationBar from '@/components/NavigationBar'
  // import Footer from '@/components/Footer'

  export default {
    name: 'DefaultLayout',
    // components: {
    //   ApplicationToolbar,
    //   ApplicationInnerNavigationBar,
    //   Footer
    // },
    computed: {
      isNavigationBarDisplayed () {
        return !!(this.$route.params && this.$route.params.project_id)
      },

      navigationBarLinks () {

        const navigationBarLinks = {
          'ProjectView': [
            {
              to: { name: 'pushex.projects.project.configuration'},
              toLanding: { name: 'pushex.projects.project.configuration.landing'},
              title: this.$store.getters.localization.navigationBar.project_configuration,
              icon: 'settings'
            },
            {
              to: { name: 'pushex.projects.project.popupConfiguration' },
              title: this.$store.getters.localization.navigationBar.subscription,
              icon: 'mail_outline',
              hideForLanding: true
            },
            {
              to: { name: 'pushex.projects.project.setup', params: { platform: 'html' } },
              title: this.$store.getters.localization.navigationBar.project_setup,
              icon: 'code',
              hideForLanding: true
            },
            {
              to: { name: 'pushex.projects.project.statistic' },
              title: this.$store.getters.localization.navigationBar.project_statistic,
              icon: 'show_chart'
            },
            {
              to: { name: 'pushex.projects.project.messages' },
              title: this.$store.getters.localization.navigationBar.project_messages,
              icon: 'message'
            },
            {
              to: { name: 'pushex.projects.project.segments' },
              title: this.$store.getters.localization.navigationBar.project_segments,
              icon: 'fa-chart-pie'
            }
          ]
        }

        let currentView = null

        if (this.$route.path && this.$route.params) {
          if (this.$route.params.project_id) currentView = 'ProjectView'
        }

        return navigationBarLinks[currentView] || []
      }
    }
  }
</script>

<style lang="scss">
  .pushex {
    backface-visibility: hidden;
    display: flex;
    flex: 1 1 auto;
    flex-direction: column;
    max-width: 100%;
    min-height: 100% !important;
    position: relative;

    &__wrapper {
      align-items: flex-start !important;
    }
  }
</style>
