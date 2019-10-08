import Vue from 'vue'
import Router from 'vue-router'

import Home from '@page/Home.vue'
import Register from '@page/Register.vue'
import Login from '@page/Login.vue'
import Responses from '@page/Responses.vue'
// Administrador
import Admin from '@page/Admin.vue'
// Usuario
import UserIndex from '@views/user/Index.vue'
import UserList from '@views/user/List.vue'
import UserProfile from '@views/user/Profile.vue'
// Partidos
import MatchDay from '@views/match/Index.vue'
import MatchDayList from '@views/match/List.vue'
import MatchDayCreate from '@views/match/Create.vue'
import MatchDayEdit from '@views/match/Edit.vue'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'path_home',
      component: Home,
      props: true
    },
    {
      path: '/login',
      name: 'path_login',
      component: Login
    },
    {
      path: '/register',
      name: 'path_register',
      component: Register
    },
    {
      path: '/responses',
      name: 'path_response',
      component: Responses
    },
    {
      path: '/admin',
      component: Admin,
      children: [
        {
          path: '/user',
          component: UserIndex,
          children: [
            {
              path: 'list',
              name: 'path_user_list',
              component: UserList
            },
            {
              path: 'profile',
              name: 'path_user_profile',
              component: UserProfile
            }
          ]
        },
        {
          path: 'match',
          component: MatchDay,
          children: [
            {
              path: '/',
              name: 'path_match_index',
              component: MatchDayList,
              props: true
            },
            {
              path: 'create',
              name: 'path_match_create',
              component: MatchDayCreate
            },
            {
              path: 'edit/:id',
              name: 'path_match_edit',
              component: MatchDayEdit
            }
          ]
        }
      ]
    }
  ]
})
