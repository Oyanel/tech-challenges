import routes from './routes/routes.json';

class SurveyService {

    constructor(){
        this.host = routes.host;
    }

    async getListSurveys() {
        const endPoint = routes.survey.list_all;
        const promise = new Promise((resolve, reject) => {
            fetch(this.host + endPoint)
                .then(res => res.json())
                .then(surveys => resolve(surveys))
                .catch(err => reject(err));
        });
        return promise;
    }
}

export default SurveyService;
