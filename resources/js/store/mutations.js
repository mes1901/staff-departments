export default {
    setSpinner: (state, { text, status }) => {
        state.spinner.text = text !== undefined ? text : 'loading...'
        if (status !== undefined) {
            state.spinner.loading = status
        }
    },

    successNotification: (state, text) => {
        state.notification.text = text
        state.notification.type = 'success'
        state.notification.active = true
    },

    failedNotification: (state, text) => {
        state.notification.text = text
        state.notification.type = 'danger'
        state.notification.active = true
    },

    setEmployeesData: (state, data) => {
        state.employeesReport.data = data
    },

    setEmployeesRowsCount: (state, data) => {
        state.employeesReport.totalRows = data
    },

    setDepartments: (state, data) => {
        let options = []
        data.forEach(element => {
            options.push({
                text: element.name,
                value: element.id,
            })
        })

        state.departmentsOptions = options
    },
}