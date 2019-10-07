import Vue from 'vue'
import Router from 'vue-router'

import Home from '@page/Home.vue'
import MatchDay from '@page/MatchDay.vue'

import MatchDayCreate from '@views/match_day/Create.vue'
import MatchDayParticipe from '@views/match_day/MatchDayParticipe.vue'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/match_day',
      component: MatchDay,
      children: [
        {
          path: 'create',
          name: 'match_day_create',
          component: MatchDayCreate
        },
        {
          path: 'participate',
          name: 'match_day_participate',
          component: MatchDayParticipe
        }
      ]
    }
  ]
})
