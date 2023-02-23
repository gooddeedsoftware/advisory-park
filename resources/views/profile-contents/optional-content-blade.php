<div class="overview-box" id="overview-box">
    <div class="overview-edit">
        <h3>Overview</h3>
        <span>5000 character left</span>
        <form action="{{route('profile.update')}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{Auth::user()->id}}" />
            <textarea name="overview">{{Auth::user()->overview}}</textarea>
            <button type="submit" class="save">Update</button>
        </form>
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
    </div>
</div>

<div class="overview-box" id="experience-box">
    <div class="overview-edit">
        <h3>Experience</h3>
        <form>
            <input type="text" name="subject" placeholder="Subject" />
            <textarea></textarea>
            <button type="submit" class="save">Update</button>
            <!--<button type="submit" class="save-add">Save & Add More</button>-->
            <!--<button type="submit" class="cancel">Cancel</button>-->
        </form>
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
    </div>
    <!--overview-edit end-->
</div>

<div class="overview-box" id="education-box">
    <div class="overview-edit">
        <h3>Education</h3>
        <form>
            <input type="text" name="school" placeholder="School / University" />
            <div class="datepicky">
                <div class="row">
                    <div class="col-lg-6 no-left-pd">
                        <div class="datefm">
                            <input type="text" name="from" placeholder="From" class="datepicker" />
                            <i class="fa fa-calendar"></i>
                        </div>
                    </div>
                    <div class="col-lg-6 no-righ-pd">
                        <div class="datefm">
                            <input type="text" name="to" placeholder="To" class="datepicker" />
                            <i class="fa fa-calendar"></i>
                        </div>
                    </div>
                </div>
            </div>
            <input type="text" name="degree" placeholder="Degree" />
            <textarea placeholder="Description"></textarea>
            <button type="submit" class="save">Save</button>
            <!--<button type="submit" class="save-add">Save & Add More</button>-->
            <!--<button type="submit" class="cancel">Cancel</button>-->
        </form>
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
    </div>
    <!--overview-edit end-->
</div>

<div class="overview-box" id="location-box">
    <div class="overview-edit">
        <h3>Address</h3>
        <form>
            <div class="datefm">
                <select>
                    <option>Country</option>
                    <option value="pakistan">Pakistan</option>
                    <option value="england">England</option>
                    <option value="india">India</option>
                    <option value="usa">United Sates</option>
                </select>
                <i class="fa fa-globe"></i>
            </div>
            <div class="datefm">
                <select>
                    <option>City</option>
                    <option value="london">London</option>
                    <option value="new-york">New York</option>
                    <option value="sydney">Sydney</option>
                    <option value="chicago">Chicago</option>
                </select>
                <i class="fa fa-map-marker"></i>
            </div>
            <button type="submit" class="save">Update</button>
            <!--<button type="submit" class="cancel">Cancel</button>-->
        </form>
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
    </div>
    <!--overview-edit end-->
</div>

<div class="overview-box" id="skills-box">
    <div class="overview-edit">
        <h3>Skills</h3>
        <ul>
            <li>
                <a href="#" title="" class="skl-name">HTML</a><a href="#" title="" class="close-skl"><i class="la la-close"></i></a>
            </li>
            <li>
                <a href="#" title="" class="skl-name">php</a><a href="#" title="" class="close-skl"><i class="la la-close"></i></a>
            </li>
            <li>
                <a href="#" title="" class="skl-name">css</a><a href="#" title="" class="close-skl"><i class="la la-close"></i></a>
            </li>
        </ul>
        <form>
            <input type="text" name="skills" placeholder="Skills" />
            <button type="submit" class="save">Update</button>
            <!--<button type="submit" class="save-add">Save & Add More</button>-->
            <!--<button type="submit" class="cancel">Cancel</button>-->
        </form>
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
    </div>
    <!--overview-edit end-->
</div>

<div class="overview-box" id="create-portfolio">
    <div class="overview-edit">
        <h3>Create Portfolio</h3>
        <form>
            <input type="text" name="pf-name" placeholder="Portfolio Name" />
            <div class="file-submit">
                <input type="file" name="file" />
            </div>
            <div class="pf-img">
                <img src="#" alt="" />
            </div>
            <input type="text" name="website-url" placeholder="htp://www.example.com" />
            <button type="submit" class="save">Update</button>
            <!--<button type="submit" class="cancel">Cancel</button>-->
        </form>
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
    </div>
    <!--overview-edit end-->
</div>

<!--<div class="overview-box" id="overview-box">
    <div class="overview-edit">
        <h3>Add Business Profile</h3>
        <form action="{{route('profile.update')}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{Auth::user()->id}}" >
            <textarea name="overview">{{Auth::user()->overview}}</textarea>
            <button type="submit" class="save">Update</button>
        
        </form>
        <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
        
        
    </div>
</div>
-->
