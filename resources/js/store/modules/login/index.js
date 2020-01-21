const login = {
    namespaced: true,
    state: {
        email: '',
        password: '',
    },
    mutations: {
        updateEmail(state, value) {
            state.email = value;
        },
        updatePassword(state, value) {
            state.password = value;
        },
        clearForm(state) {
            state.email = '';
            state.password = '';
        }
    }
};

export default login;
