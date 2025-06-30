"use client";

import { IProduct } from "@/interfaces/IProduct";
import Image from "next/image";
import Link from "next/link";

interface ProductItemProps {
  product: IProduct;
}

const ProductItem = ({ product }: ProductItemProps) => {
  return (
    <Link href={`/product/${product.id_produto}`}>
      <div className="border border-gray-300 p-4">
        <div className="relative h-100 w-70">
          <Image
            src={`http://localhost:8081/produtos/imagens/${product.imagem}`}
            alt={product.produto}
            fill
            sizes="100%"
            className="object-cover border border-gray-300"
          />
        </div>
        <h3>{product.produto}</h3>
        <p>{product.descricao}</p>
        <span>R$ {product.preco}</span>
      </div>
    </Link>
  );
};

export default ProductItem;
