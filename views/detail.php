<!DOCTYPE html>
<html>
<head>
<title>Teste PHP - Home Page</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        require_once '../config/properties.php';
        require_once 'header.php';
        require_once '../controller/AtividadeController.php';
        
        $teste = new AtividadeController(); 
        $dados = $teste->listToView();
        ?>
       
    </head>

<body>
	<div class="container">
				<?php 
				//verifica se é update e pega valores default
			     if(isset($_GET['id'])){
				    $updatemode = $_GET['id'];
				 }
				 $tituloForm = "Cadastro";
    		     if(isset($updatemode)){
    			    $controleAtividade = new AtividadeController();
    			    $dadosAtividade = $controleAtividade->getlistAtividades($updatemode);
    			    $dadoAtividade = $dadosAtividade[0];
    			    //var_dump($dadosAtividade);
    			    $tituloForm = "Atualização";
    		     }
    		     //Verifica se é permitido o Update
    		     if(isset($updatemode)){
    		         if($dadoAtividade['status']=="Concluído"){
    		             $edicao = false; 
    		         }
    		     }
				
    		     ?>
				
				<?php if(isset($updatemode)): ?>                        
                     <input type="hidden" value="<?php echo $updatemode;?>" id="idUpdade">
                <?php endif; ?>
                
		<form class="form-horizontal" id="formAtividade" >
			<fieldset> 
				<!-- Form Name -->			
				 
				<legend><?php echo $tituloForm;?> de atividades <?php isset($edicao)? print "<i>( Concluída, Somente Leitura )</i>" : null ?></legend>
		 
				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="nome">Nome</label>
					<div class="col-md-4">
						<input id="nome" name="nome" type="text"
							placeholder="Entre com o nome" class="form-control input-md"
							required value="<?php isset($updatemode)? print $dadoAtividade['nome']:null;?>">

					</div>
				</div>

				<div class="form-group">
				<label class="col-md-4 control-label">Descrição</label>
				<div class="col-md-4">
                    <textarea class="form-control" type="textarea" id="descricao" name="descricao" placeholder="Descrição" maxlength="600" rows="7"><?php isset($updatemode)? print $dadoAtividade['descricao']:null;?></textarea>
                        <span class="help-block"><p id="characterLeft" class="help-block ">Você chegou ao limite</p></span>                    
                 </div>
                 </div>
                    
				<div class="form-group">
					<label for="dtp_input1" class="col-md-4 control-label">Data Inicial</label>
					<div class="input-group date form_datetime col-md-4"
						data-date="2016-09-16T05:25:07Z"
						data-date-format="dd MM yyyy - HH:ii p"
						data-link-field="dtp_input1">
						<input class="form-control input-md"  type="text" id="data_inicio" name="data_inicio"  value="<?php isset($updatemode)? print $dadoAtividade['data_inicio']:null;?>" 
							readonly> <span class="input-group-addon"><span
							class="glyphicon glyphicon-remove"></span></span> <span
							class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
					</div>
					<input type="hidden" id="dtp_input1" name="data_inicio" value="<?php isset($updatemode)? print $dadoAtividade['data_inicio']:null;?>" /><br />
				</div>

				<div class="form-group">
					<label for="dtp_input2" class="col-md-4 control-label datafinal">Data Final</label>
					<div class="input-group date form_datetime col-md-4"
						data-date="2016-09-16T05:25:07Z"
						data-date-format="dd MM yyyy - HH:ii p"
						data-link-field="dtp_input2">
						<input class="form-control  input-md"  type="text" id="data_fim" name="data_fim"  value="<?php isset($updatemode)? print $dadoAtividade['data_fim']:null;?>" 
							readonly> 
							<span class="input-group-addon">
							<span class="glyphicon glyphicon-remove">
							</span></span> 
							<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
					</div>
					<input type="hidden" id="dtp_input2" name="data_fim" value="<?php isset($updatemode)? print $dadoAtividade['data_fim']:null;?>" /><br />
				</div>

				 <div id="situacao" class="form-group required">
                            <label for="id_gender"  class="control-label col-md-4  requiredField"> Situação<span class="asteriskField">*</span> </label>
                            <div class="controls col-md-4 "  style="margin-bottom: 10px">
                                 <label class="radio-inline"> <input type="radio" name="situacao" id="sit_ativo" value="1" 
                                 <?php 
                                 if(isset($updatemode)){
                                     if($dadoAtividade['situacao'] == '1'){
                                         echo 'checked';
                                     }                                     
                                 }   
                                 ?> style="margin-bottom: 10px">Ativo</label>
                                 <label class="radio-inline"> <input type="radio" name="situacao" id="sit_inativo" value="0"  
                                  <?php 
                                 if(isset($updatemode)){
                                     if($dadoAtividade['situacao'] == '0'){
                                         echo 'checked';
                                     }                                     
                                 }   
                                 ?>                                 
                                 style="margin-bottom: 10px">Inativo </label>
                            </div>
                        </div>

				<!-- Select Basic -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="status">Status</label>
					<div class="col-md-4"> 
					<?php 
				           $listaAllStatus = new AtividadeController();
				           $listaStatus = $listaAllStatus->getlistStatus();					          
						 ?>
						<select id="status" name="status" class="form-control">
						<option value="">Selecione</option>
							<?php foreach ($listaStatus as $status): ?>
								<option value="<?php echo $status['id'];?>" 
								 <?php 
                                 if(isset($updatemode)){
                                     if($dadoAtividade['id'] == $status["id"]){
                                         echo ' selected';
                                     }                                     
                                 }                                 
                                 ?>><?php echo $status['status'];?></option>
							<?php endforeach; ?>	
						</select>
					</div>
				</div>
 
				<!-- Button -->
				<div class="form-group botoes">
					<label class="col-md-4 control-label" for="cadastrar"></label>
					<div class="col-md-2 btn-cancelar">
					    <a class="btn btn-danger" href="./list.php">Cancelar</a> 
					</div>
					<div class="col-md-6 btn-cadastrar" <?php isset($edicao)? print "style='display:none;'" : null ?> >
						<?php if(isset($updatemode)):?>
							<input type="submit" class="btn btn-warning" value="&nbsp;Atualizar&nbsp;" id="atualiza" name="atualiza">
						<?php else: ?>
							<input type="submit" class="btn btn-success" value="Cadastrar" id="cadastra" name="cadastra">
						<?php endif; ?>
					</div>
				</div>
				 

			</fieldset>
		</form>

	</div>
 

</body>
</html>