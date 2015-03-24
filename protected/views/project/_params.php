<table class="all-params">
    <tbody>
    <? foreach ($fields as $key => $section): ?>
        <?//проверка на заполненность подраздела
            if($key=='contact'){
                $data=array( //не используется
                    array('key'=>'contact_face','name'=>$project->getAttributeLabel('contact_face'),'value'=>$project->getContactAttr('contact_face')),
                    array('key'=>'contact_role','name'=>$project->getAttributeLabel('contact_role'),'value'=>$project->getContactAttr('contact_role')),
                    array('key'=>'contact_address','name'=>$project->getAttributeLabel('contact_address'),'value'=>$project->getContactAttr('contact_address')),
                    array('key'=>'contact_phone','name'=>$project->getAttributeLabel('contact_phone'),'value'=>$project->getContactAttr('contact_phone')),
                    array('key'=>'contact_fax','name'=>$project->getAttributeLabel('contact_fax'),'value'=>$project->getContactAttr('contact_fax')),
                    array('key'=>'contact_email','name'=>$project->getAttributeLabel('contact_email'),'value'=>$project->getContactAttr('contact_email')),
                );
            }
            else{
                $data = array();
                foreach ($section['items'] as $id => $type){ //заполним массив $data значениями из текущего подраздела
                    if(in_array($id, array('name','region_id','period','profit_clear','profit_norm','industry_type'))){
                        $data[] = array(
                            'key'=>$id,
                            'name'=>$project->getAttributeLabel($id),
                            'value'=>Project::getFieldValue($project,$id,$type)
                        );
                    }
                    elseif(isset($project->{Project::$params[$project->type]['relation']}->{$id}) || $key=='building'){
                        $value = Project::getFieldValue($project->{Project::$params[$project->type]['relation']}, $id,$type);
                        if(empty($value))
                            continue;
                        $data[] = array(
                            'key'=>$id,
                            'name'=>$project->{Project::$params[$project->type]['relation']}->getAttributeLabel($id),
                            'value'=>$value
                        );
                    }
                    else{
                        continue;
                    }
                }
            }
            if(count($data)==0){
                continue;
            }
        ?>
        <tr class="header">
            <td colspan="2">
                <span><?=$section['name']?></span>
            </td>
        </tr>
        <?foreach ($data as $item): ?>
            <?php if(empty($item['value']) && $key!='contact'):?><?continue?><?php endif;?>
            <tr>
                <td><?=$item['name']?></td>
                <td class="value"><?=$item['value']?></td>
            </tr>
        <?endforeach; ?>
    <? endforeach ?>
    </tbody>
</table>