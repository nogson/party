import Vue from 'vue'
import Router from 'vue-router'
import { interopDefault } from './utils'
import scrollBehavior from './router.scrollBehavior.js'

const _a3a13a74 = () => interopDefault(import('../front/pages/friend.vue' /* webpackChunkName: "pages/friend" */))
const _57fe621e = () => interopDefault(import('../front/pages/login.vue' /* webpackChunkName: "pages/login" */))
const _65ef72da = () => interopDefault(import('../front/pages/notification.vue' /* webpackChunkName: "pages/notification" */))
const _8fbc6d1a = () => interopDefault(import('../front/pages/user.vue' /* webpackChunkName: "pages/user" */))
const _8f8740fe = () => interopDefault(import('../front/pages/oauth/twitter/callback.vue' /* webpackChunkName: "pages/oauth/twitter/callback" */))
const _72499398 = () => interopDefault(import('../front/pages/oauth/twitter/redirect.vue' /* webpackChunkName: "pages/oauth/twitter/redirect" */))
const _0a592bda = () => interopDefault(import('../front/pages/index.vue' /* webpackChunkName: "pages/index" */))

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
    component: _a3a13a74,
    name: "friend"
  }, {
    path: "/login",
    component: _57fe621e,
    name: "login"
  }, {
    path: "/notification",
    component: _65ef72da,
    name: "notification"
  }, {
    path: "/user",
    component: _8fbc6d1a,
    name: "user"
  }, {
    path: "/oauth/twitter/callback",
    component: _8f8740fe,
    name: "oauth-twitter-callback"
  }, {
    path: "/oauth/twitter/redirect",
    component: _72499398,
    name: "oauth-twitter-redirect"
  }, {
    path: "/",
    component: _0a592bda,
    name: "index"
  }],

  fallback: false
}

export function createRouter () {
  return new Router(routerOptions)
}
