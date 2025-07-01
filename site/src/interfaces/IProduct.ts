export interface IProduct {
  id_produto: number;
  produto: string;
  descricao: string | null;
  id_marca: number;
  imagem: string | null;
  preco: number | null;
  marca: string;
}
