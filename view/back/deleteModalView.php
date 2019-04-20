<!-- Modal Suppression-->
<div class="modal fade" id="deleteForm<?= $element_id ?>" tabindex="-1" role="dialog" aria-labelledby="deleteForm<?= $element_id ?>">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteForm<?= $element_id ?>">Confirmation de suppression</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
        <div class="modal-body">
            <form action="index.php?action=deleteBanner&amp;id=<?= $element_id ?>" method="post" id="delete-form-<?= $element_id ?>">
              <div class="form-check">
                <p>Je souhaite définitivement supprimer cet élément.</p>
                <div class="alert alert-danger" role="alert">
                  Attention, toute suppression est irréversible !
                </div>
              </div>
            </form>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-danger" form="delete-form-<?= $element_id ?>">Confirmer</button>
            </div>
        </div>
    </div>
</div>