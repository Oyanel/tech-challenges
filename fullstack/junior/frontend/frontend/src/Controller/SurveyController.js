import SurveyService from '../Services/SurveyService';

class SurveyController {

    constructor() {
        this.service = new SurveyService();
    }

    async getList() {
        return this.service.getListSurveys();
    }
}

export default SurveyController;
