'use strict'

import Vue from 'vue'
import axios from 'axios'
import loading from '../services/loading'
import store from '@/store'
import httpStatus from '@/services/httpStatus'
import { Message, MessageBox } from 'element-ui'
import router from '../router'
// Full config:  https://github.com/axios/axios#request-config
// axios.defaults.baseURL = process.env.baseURL || process.env.apiUrl || '';
// axios.defaults.headers.common['Authorization'] = AUTH_TOKEN;
// axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
// axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

// axios.defaults.headers.common['Authorization'] = 'Bearer ' + window.localStorage.getItem('access_token')

//基本地址与超时时间
let config = { baseURL: '/api', timeout: 5 * 1000 }
const _axios = axios.create(config)

//访问方式
//1：window对象与Vue对象全局可调用
//2：在组件中使用this.$axios或this.axios的原型方法访问
window.axios = Vue.axios = _axios
Object.defineProperties(Vue.prototype, {
  axios: {
    get() {
      return _axios
    }
  },
  $axios: {
    get() {
      return _axios
    }
  }
})

//请求拦截器
_axios.interceptors.request.use(
  function(config) {
    //显示加载动画
    loading.show()
    return config
  },
  function(error) {
    return Promise.reject(error)
  }
)

// 响应拦截器
_axios.interceptors.response.use(
  function(response) {
    //关闭加载动画
    loading.close()
    return response
  },
  function(error) {
    loading.close()
    if (error && error.response) {
      let status = error.response.status
      switch (status) {
        case 401:
          //未登录用户跳转到登录页面
          // location.href = '/login'
          break
        case 422:
          //表单验证错误，错误消息记录到VUEX中
          store.commit('error/set', error.response.data.errors)
          break
        default:
          //其它错误消息直接显示错误信息
          let message = error.response.data.message
          message = message ? message : httpStatus(error.response.status)
          MessageBox.alert(message, '错误提示', { type: 'warning', center: true })
      }
      return Promise.reject(error)
    }
    //未正确返回状态码的错误处理
    Message.error('网络超时')
    return Promise.reject(error)
  }
)
