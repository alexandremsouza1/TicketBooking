import * as types from './mutation-types'
import { post, get } from '../../../helpers/api'

export const checkAuthenticated = ({ commit }) => {
    commit(types.CHECK_AUTHENTICATED);
};

export const login = ({ commit }, data) => {
    return new Promise((resolve, reject) => {
        post('auth/login', data)
            .then(response => {
                commit(types.LOGIN, response.data);
                commit(types.SET_USER, response.data.data.user);
                resolve(response.status);
            })
            .catch(error => {
                reject(error);
            });
    })
}

export const setUser = ({ commit }) => {
    return new Promise((resolve, reject) => {
        get('auth/user')
            .then(response => {
                commit(types.SET_USER, response.data.data.user);
                resolve(response.status);
            })
            .catch(error => {
                reject(error);
            });
    })
}

export const logout = ({ commit }) => {
    commit(types.LOGOUT);
};

export const register = ({ commit }, data) => {
    return new Promise((resolve, reject) => {
        post('auth/register', data)
            .then(response => {
                commit(types.LOGIN, response.data);
                commit(types.SET_USER, response.data.data.user);
                resolve(response.status);
            })
            .catch(error => {
                reject(error);
            });
    })
}

export default {
    checkAuthenticated,
    login,
    setUser,
    logout,
    register
}