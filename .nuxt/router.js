import Vue from 'vue'
import Router from 'vue-router'
import { interopDefault } from './utils'
import scrollBehavior from './router.scrollBehavior.js'

const _20f4f7cc = () => interopDefault(import('../front/pages/home.vue' /* webpackChunkName: "pages/home" */))
const _1f0fe5be = () => interopDefault(import('../front/pages/login.vue' /* webpackChunkName: "pages/login" */))
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
    path: "/home",
    component: _20f4f7cc,
    name: "home"
  }, {
    path: "/login",
    component: _1f0fe5be,
    name: "login"
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
