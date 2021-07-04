import requestService from '../services/requestService'

const apiUrl = window.location.origin + '/api'

export default {
    fetchEmployeesList: (context, criteria) => {
        context.commit('setSpinner',
            { text: 'Loading employees...', status: true })

        return requestService.get(apiUrl + '/employees', criteria).
            then(response => {
                context.commit('setEmployeesData', response['data'])
                context.commit('setEmployeesRowsCount',
                    response['total_count'])
            }).
            catch(error => {
                context.commit('failedNotification',
                    error.response.data.error.message)
            }).
            finally(() => {
                context.commit('setSpinner', { status: false })
            })
    },

    fetchDepartments: (context) => {
        context.commit('setSpinner',
            { text: 'Loading departments...', status: true })

        return requestService.get(apiUrl + '/departments').
            then(response => {
                context.commit('setDepartments', response)
            }).
            catch(error => {
                context.commit('failedNotification',
                    error.response.data.error.message)
            }).
            finally(() => {
                context.commit('setSpinner', { status: false })
            })
    },

    fetchPageData: (context) => {
        context.dispatch('fetchEmployeesList', {
            currentPage: 1,
            perPage: 10,
            department: 0
        })
        context.dispatch('fetchDepartments')
    },

    fileUpload: (context, file) => {
        context.commit('setSpinner',
            { text: 'File uploading...', status: true })

        let formData = new FormData();
        formData.append('file', file);

        return requestService.create(apiUrl + '/upload-file', formData, {
            'content-type': 'multipart/form-data'
        }).
            then(() => {
                context.commit('successNotification', 'File uploaded successfully!')
            }).
            catch(error => {
                context.commit('failedNotification',
                    error.response.data.error.message)
            }).
            finally(() => {
                context.commit('setSpinner', { status: false })
            })
    },

}