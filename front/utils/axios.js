import {useLoading} from "~/utils/custom.js";
import axios from 'axios'

export const useAxios = (loading = true) => {
    const axiosInstance = axios.create();

    if (process.client) {
        axiosInstance.interceptors.request.use(
            (config) => {
                if (loading) useLoading(true);
                return config;
            },
            (error) => {
                if (loading) useLoading(false);
                return Promise.reject(error);
            }
        );

        axiosInstance.interceptors.response.use(
            (response) => {
                if (loading) useLoading(false);
                return response;
            },
            (error) => {
                if (loading) useLoading(false);
                return Promise.reject(error);
            }
        );
    }

    const runtimeConfig = useRuntimeConfig()
    axiosInstance.defaults.baseURL = runtimeConfig.public.apiUrl
    axiosInstance.defaults.withCredentials = true
    return axiosInstance
}