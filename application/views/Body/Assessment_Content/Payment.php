<style>
    .align_center{
        text-align: center;
    }
    /* .header{
        text-align: center;
    } */
    .first_div{
        padding:0px 0 10px 0;
    }
    .ul_class{
        text-align: center;
        list-style: none;
        background-color: rgba(200, 200, 200, 0.2); 
        width: 100%;
        padding: 7px 0 7px 0;
        margin: 0; 
    }
    .li_class{
        display: inline; width: 33.3333%;
        text-decoration: none;
        color: black;
        padding: 10px 10% 10px 10%;
    }
    .active_class{
        background-color: #4caf50;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 16px 26px -10px rgb(76 175 80 / 56%), 0 4px 25px 0px rgb(0 0 0 / 12%), 0 8px 10px -5px rgb(76 175 80 / 20%);
    }
    /* .body_class h4{
        text-align: center;
    }
    .body_class_title{
        text-align: center;
    } */
    .body_class_selections{
        display: flex;
        justify-content: center;
    }
    .choice_check_box{
        display: grid;
        margin: 8%;
    }
    /* .choice_check_box h6{
        text-align: center;
    } */
    .body_class_selections_circle{
        /* margin: auto; */
        
    }
    .body_class_selections_circle{
        /* text-align: center; */
        /* vertical-align: middle; */
        display: inline-block;
        height: 116px;
        width: 116px;
        border-radius: 50%;
        color: #999999;
        margin: 0 auto 20px;
        border: 4px solid #CCCCCC;
    }
    .body_class_selections_circle:hover{
        border-color: #4caf50;
        color: #4caf50;
        cursor: pointer;
    }
    .form_input_group{
        display: table;
    }
    .form_group_text{
        border: 0;
        background-image: linear-gradient(#9c27b0, #9c27b0), linear-gradient(#D2D2D2, #D2D2D2);
        background-size: 0 2px, 100% 1px;
        background-repeat: no-repeat;
        background-position: center bottom, center calc(100% - 1px);
        background-color: transparent;
        transition: background 0s ease-out;
        float: none;
        box-shadow: none;
        border-radius: 0;
        font-weight: 400;
        width: 40%;
    }
    #circle_selection_icon{
        position: relative;
        top: 18px;
        font-size: 60px;
    }
    #student_number_icon{
        font-size: 25px;
        position: relative;
        top: 7px;
    }
    .footer_button_color{
        display: block;
        float: right;
        background-color: #4caf50;
    }

    @media only screen and (max-width: 1000px) {
        .li_class{
            padding: 10px 5% 10px 5%;
        }
    }
    @media only screen and (max-width: 629px) {
        .li_class{
            display: inline-block;
            margin: 0;
            width: 96%;
        }
        .body_class_selections{
            display: grid;
            justify-content: center;
        }
        .footer_button_color{
            display: inline-grid;
            float: none;
            background-color: #4caf50;
        }
    }
</style>
<div class="align_center">
    <div class="row">
        <div class="header">
            <h3>Payment Form</h3>
            <h5>Fill out the form to proceed with the payment</h5>
        </div>
        <div class="first_div">
            <ul class="ul_class">
                <a href="" class="active_class">
                    <li class="li_class">
                        BASIC INFO
                    </li>
                </a>
                <a href="" class="">
                    <li class="li_class">
                        ACADEMIC INFO
                    </li>
                </a>
                <a href="" class="">
                    <li class="li_class">
                        CONTACT DETAILS
                    </li>
                </a>
            </ul>
        </div>
        <div class="body_class">
            <div class="body_class_title">
                <h4>Please answer the form below</h4>    
            </div>
            <div class="body_class_selections">
                <div class="choice_check_box">
                    <div class="body_class_selections_circle">
                        <i class="bi bi-pencil" id="circle_selection_icon"></i>
                    </div>
                    <h6>BASIC EDUCATION</h6>
                </div>
                <div class="choice_check_box">
                    <div class="body_class_selections_circle">
                        <i class="bi bi-people-fill" id="circle_selection_icon"></i>
                    </div>
                    <h6>SENIOR HIGHSCOOL</h6>
                </div>
                <div class="choice_check_box">
                    <div class="body_class_selections_circle">
                        <i class="bi bi-laptop" id="circle_selection_icon"></i>
                    </div>
                    <h6>HIGHER EDUCATION</h6>
                </div>
            </div>
            <hr>
            <h4>Student's Student Number or Reference Number</h4>
        </div>
        <div class="col-sm-12">
            <div class="form_input-group">
                <div class="form-group label-floating is-empty">
                    <i class="bi bi-person-circle" id="student_number_icon"></i>
                    <input type="text" name="" id="" class="form_group_text">
                </div>
            </div>
        </div>
        <div class="payment_footer">
            <div class="payment_footer_button col-md-12">
                <input type="submit" name="" id="submit" class="btn btn-next btn-fill btn-success btn-wd footer_button_color">
            </div>
            <br>
            <h5>Need help with something? Visit our <a href="https://stdominiccollege.edu.ph/SDCAHelpdesk">Helpdesk</a></h5>
            <h6><a href="https://stdominiccollege.edu.ph">Back to home</a></h6>
        </div>
        <!-- <div style="background-color: #4caf50; padding: 25px 0 25px 0; width:33%; z-index:-1; position:relative; top:-46px;"></div> -->
    </div>
</div>