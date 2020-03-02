import Vue from 'vue'
import Router from 'vue-router'
import { interopDefault } from './utils'
import scrollBehavior from './router.scrollBehavior.js'

const _75f9b4ce = () => interopDefault(import('../front/pages/friend.vue' /* webpackChunkName: "pages/friend" */))
const _1f0fe5be = () => interopDefault(import('../front/pages/login.vue' /* webpackChunkName: "pages/login" */))
const _4c455f26 = () => interopDefault(import('../front/pages/notification.vue' /* webpackChunkName: "pages/notification" */))
const _06c3b5f4 = () => interopDefault(import('../front/pages/user.vue' /* webpackChunkName: "pages/user" */))
const _0163c758 = () => interopDefault(import('../front/pages/oauth/twitter/callback.vue' /* webpackChunkName: "pages/oauth/twitter/callback" */))
const _8d495f2a = () => interopDefault(import('../front/pages/oauth/twitter/redirect.vue' /* webpackChunkName: "pages/oauth/twitter/redirect" */))
const _556842a7 = () => interopDefault(import('../front/pages/index.vue' /* webpackChunkName: "pages/index" */))

// TODO: remove in Nuxt 3
const emptyFn = () => {}
const originalPush = Router.prototype.push
Router.prototype.push = function push (location, onComplete = emptyFn, onAbort) {
  return originalPush.call(this, location, onComplete, onAbort)
}

Vue.use(Router)

export const routerOptions = {
  mode: 'history',
  base: decodeURI('/'),
  linkActiveClass: 'nuxt-link-active',
  linkExactActiveClass: 'nuxt-link-exact-active',
  scrollBehavior,

  routes: [{
    path: "/friend",
    component: _75f9b4ce,
    name: "friend"
  }, {
    path: "/login",
    component: _1f0fe5be,
    name: "login"
  }, {
    path: "/notification",
    component: _4c455f26,
    name: "notification"
  }, {
    path: "/user",
    component: _06c3b5f4,
    name: "user"
  }, {
    path: "/oauth/twitter/callback",
    component: _0163c758,
    name: "oauth-twitter-callback"
  }, {
    path: "/oauth/twitter/redirect",
    component: _8d495f2a,
    name: "oauth-twitter-redirect"
  }, {
    path: "/",
    component: _556842a7,
    name: "index"
  }],

  fallback: false
}

export function createRouter () {
  return new Router(routerOptions)
}
