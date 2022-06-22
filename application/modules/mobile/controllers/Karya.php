<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Karya extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_stakeholder');
        $this->load->model('m_karya');
    }
    public function index(){
        $query = $this->m_karya->getAllKarya()->result();
        echo json_encode($query);
    }

    public function get_dokumen($id){
        $query = $this->m_stakeholder->getDokumenKarya($id)->result();
        echo json_encode($query);
    }
    public function search_karya(){
        $keyword = $this->input->post('keyword');
        $query = $this->m_karya->getKarya($keyword)->result();
        echo json_encode($query);
    }
}

// private void requestUploadSurvey () {
//     File propertyImageFile = new File(surveyModel.getPropertyImagePath());
//     RequestBody propertyImage = RequestBody.create(MediaType.parse("image/*"),propertyImageFile);
//     MultipartBody.Part propertyImagePart = MultipartBody.Part.createFormData("PropertyImage",propertyImageFile.getName(),  propertyImage);

//     MultipartBody.Part[] surveyImagesParts = new MultipartBody.Part[surveyModel.getPicturesList().size()];

//     for (int index = 0; index < surveyModel.getPicturesList().size(); index++) {
//         Log.d(TAG,"requestUploadSurvey: survey image " +index +"  " +surveyModel.getPicturesList() .get(index).getImagePath());
//         File file = new File(surveyModel.getPicturesList().get(index).getImagePath());
//         RequestBody surveyBody = RequestBody.create(MediaType.parse("image/*"),file);
//         surveyImagesParts[index] = MultipartBody.Part.createFormData("SurveyImage",file.getName(),surveyBody);
//     }

//     final WebServicesAPI webServicesAPI = RetrofitManager.getInstance()
//                                                          .getRetrofit()
//                                                          .create(WebServicesAPI.class);
//     Call<UploadSurveyResponseModel> surveyResponse = null;
//     if (surveyImagesParts != null) {
//         surveyResponse = webServicesAPI.uploadSurvey(surveyImagesParts,
//                                                      propertyImagePart,
//                                                      draBody);
//     }
//     surveyResponse.enqueue(this);
// }